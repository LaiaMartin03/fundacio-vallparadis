document.getElementById("seguiment-button").addEventListener("click", function(){
    const target = document.getElementById("seguiments");
    const toggle = this; 
    
    target.classList.toggle('hidden');
    
    
    if (target.classList.contains('hidden')) {
        toggle.textContent = 'Fer Seguiment'; 
    } else {
        toggle.textContent = 'Amagar';  
    }
});