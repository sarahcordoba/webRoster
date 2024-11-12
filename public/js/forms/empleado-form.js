function showNextSection() {
    const currentSection = document.querySelector('.form-section.active');
    const nextSection = currentSection.nextElementSibling;
    const steps = document.querySelectorAll('#steps-header .step');
    let currentStepIndex = Array.from(steps).findIndex(step => step.classList.contains('active'));

    if (nextSection && nextSection.classList.contains('form-section')) {
        // Cambiar sección activa
        currentSection.classList.remove('active');
        currentSection.classList.add('hidden');
        nextSection.classList.remove('hidden');
        nextSection.classList.add('active');

        // Avanzar al siguiente paso en el encabezado
        if (currentStepIndex < steps.length - 1) {
            steps[currentStepIndex].classList.remove('active');
            steps[currentStepIndex + 1].classList.add('active');
        }
    }
}

function showPreviousSection() {
    const currentSection = document.querySelector('.form-section.active');
    const previousSection = currentSection.previousElementSibling;
    const steps = document.querySelectorAll('#steps-header .step');
    let currentStepIndex = Array.from(steps).findIndex(step => step.classList.contains('active'));

    if (previousSection && previousSection.classList.contains('form-section')) {
        // Cambiar sección activa
        currentSection.classList.remove('active');
        currentSection.classList.add('hidden');
        previousSection.classList.remove('hidden');
        previousSection.classList.add('active');

        // Retroceder al paso anterior en el encabezado
        if (currentStepIndex > 0) {
            steps[currentStepIndex].classList.remove('active');
            steps[currentStepIndex - 1].classList.add('active');
        }
    }
}