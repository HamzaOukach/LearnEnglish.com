function handleSubmit(event) {
    event.preventDefault(); 
    var form = document.querySelector('.contact-form');
    var inputs = form.querySelectorAll('input, textarea');

    
    inputs.forEach(function(input) {
        input.value = '';
    });

    
    var thankYouMessage = document.getElementById('thank-you-message');
    thankYouMessage.style.display = 'block'; 

}
