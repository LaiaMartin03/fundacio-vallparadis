<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\EvaluationForm;
use App\Models\EvaluationFormAnswer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvaluationFormController extends Controller
{
    protected function questions(): array
    {
        return [
            'q1' => 'Realitza una correcta atenció a l\'usuari',
            'q2' => 'Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa',
            'q3' => 'S\'ha integrat dins l\'equip de treball i participa i coopera sense dificultats',
            'q4' => 'Pot treballar amb altres equips diferents al seu si es necessita',
            'q5' => 'Compleix amb les funcions establertes',
            'q6' => 'Assoleix els objectius utilitzant els recursos disponibles  per aconseguir els resultats esperats',
            'q7' => 'És coherent amb el que diu i amb les seves actuacions',
            'q8' => 'Les seves actuacions van alineades amb els valors de la nostra Entitat',
            'q9' => 'Mostra capacitat i interès en entendre i aplicar la normativa i els procediments establerts',
            'q10' => 'La seva actitud envers els seus responsables/comandaments és correcta',
            'q11' => 'Té capacitat per a comprendre i acceptar i adequar-se als canvis',
            'q12' => 'Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat/constant',
            'q13' => 'Fa suggeriments i propostes de millora',
            'q14' => 'Assoleix els objectius, esforçant-se per aconseguir el resultat esperat',
            'q15' => 'La quantitat de treball que desenvolupa en relació amb el treball encomanat és adequada',
            'q16' => 'Realitza les tasques amb la qualitat esperada i/o necessària',
            'q17' => 'Expressa amb claredat i ordre els aspectes rellevants de la informació',
            'q18' => 'Disposa del coneixements necessaris per a desenvolupar les tasques requerides del lloc de treball',
            'q19' => 'Mostra interès i motivació envers el seu lloc de treball',
            'q20' => 'La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades',
        ];
    }

    public function partial(Professional $professional)
    {
        $questions = $this->questions();
        
        $forms = EvaluationForm::leftJoin('users', 'evaluation_form.evaluator_user_id', '=', 'users.id')
            ->where('evaluation_form.professional_id', $professional->id)
            ->select('evaluation_form.*', 'users.name as evaluator_name')
            ->orderByDesc('evaluation_form.created_at')
            ->get();

        // Obtener todos los IDs de formularios
        $formIds = $forms->pluck('id');
        
        // Cargar todas las respuestas para estos formularios
        $allAnswers = EvaluationFormAnswer::whereIn('evaluation_form_id', $formIds)->get();
        
        // Agrupar respuestas por formulario_id
        $answersByForm = $allAnswers->groupBy('evaluation_form_id')->map(function($answers) {
            return $answers->keyBy('question_key');
        });

        return view('professional.partials._questionnaire', compact('professional', 'questions', 'forms', 'answersByForm'));
    }

    // guarda la evaluación (form submit)
    public function store(Request $request, Professional $professional)
    {
        $questions = array_keys($this->questions());

        $data = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer|min:1|max:4',
            'observations' => 'nullable|string',
        ]);

        $answers = $data['answers'];
        $total = array_sum($answers);

        DB::transaction(function () use ($professional, $answers, $total, $data) {
            $form = EvaluationForm::create([
                'professional_id' => $professional->id,
                'evaluator_user_id' => Auth::id(),
                'total' => $total,
                'observations' => $data['observations'] ?? null,
            ]);

            $rows = [];
            foreach ($answers as $qkey => $score) {
                $rows[] = [
                    'evaluation_form_id' => $form->id,
                    'question_key' => $qkey,
                    'score' => (int) $score,
                    'created_by' => Auth::id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            if (!empty($rows)) {
                EvaluationFormAnswer::insert($rows);
            }
        });

        return redirect()->route('professional.show', $professional->id);
    }

    // partial con medias por pregunta
    public function sumPartial(Professional $professional)
    {
        $questions = $this->questions();

        $rows = DB::table('evaluation_form_answers')
            ->join('evaluation_form','evaluation_form_answers.evaluation_form_id','=','evaluation_form.id')
            ->where('evaluation_form.professional_id', $professional->id)
            ->select('evaluation_form_answers.question_key', DB::raw('AVG(evaluation_form_answers.score) as avg_score'), DB::raw('COUNT(DISTINCT evaluation_form_answers.evaluation_form_id) as n'))
            ->groupBy('evaluation_form_answers.question_key')
            ->get()
            ->keyBy('question_key');

        return view('professional.partials._evaluations_sum', compact('professional','questions','rows'));
    }
}