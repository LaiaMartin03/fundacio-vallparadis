const collapseProfesionals = () => {
    console.log("entra")
    const section = document.getElementById('linea');

    if (section.style.display === 'none') {
        section.style.display = 'block';
    } else {
        section.style.display = 'none';
    }
}