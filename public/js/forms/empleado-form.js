//mostrar la seccion siguiente
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

//La anteroir
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

// para que la fecha de fin de contrsto sea posterior a la fecha de inicio de ocntraro
document.addEventListener('DOMContentLoaded', (event) => {
    const hiringDateInput = document.getElementById('hiring_date');
    const contractEndDateInput = document.getElementById('contract_end_date');

    contractEndDateInput.addEventListener('change', validateDates);
    hiringDateInput.addEventListener('change', validateDates);

    function validateDates() {
        const hiringDate = new Date(hiringDateInput.value);
        const contractEndDate = new Date(contractEndDateInput.value);

        if (contractEndDate < hiringDate) {
            alert('La fecha de fin de contrato debe ser posterior a la fecha de contratación.');
            contractEndDateInput.value = ''; // Clear the invalid date
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const idNumberInput = document.getElementById('id_number');
    const phoneInput = document.getElementById('phone');

    // Permitir solo números y hasta 15 caracteres para el número de identificación
    idNumberInput.addEventListener('input', () => {
        idNumberInput.value = idNumberInput.value.replace(/[^0-9]/g, '').slice(0, 15);
    });

    // Permitir solo números y hasta 15 caracteres para el teléfono
    phoneInput.addEventListener('input', () => {
        phoneInput.value = phoneInput.value.replace(/[^0-9]/g, '').slice(0, 15);
    });
});

//para cargar cosas
async function cargarMunicipios() {
    try {
        // Cargar el archivo JSON
        const response = await fetch('/data/municipios.json');
        const data = await response.json(); // Parsear el JSON

        // Obtener el elemento select
        const selectElement = document.getElementById("city");

        // Agregar las opciones dinámicamente
        data.forEach(item => {
            const option = document.createElement("option");
            // Mostrar el municipio y departamento concatenados
            option.value = item.MUNICIPIO;
            option.textContent = `${item.MUNICIPIO}, ${item.DEPARTAMENTO}`;
            selectElement.appendChild(option);
        });
    } catch (error) {
        console.error("Error al cargar el archivo JSON: ", error);
    }
}


// async function cargarTiposC() {
//     try {
//         // Cargar el archivo JSON
//         const response = await fetch('/data/tipo_cotizacion.json');
//         const data = await response.json(); // Parsear el JSON

//         // Obtener el elemento select
//         const selectElement = document.getElementById("worker_type");

//         // Agregar las opciones dinámicamente
//         data.forEach(item => {
//             const option = document.createElement("option");
//             option.value = item.id;
//             option.textContent = item.description;
//             selectElement.appendChild(option);
//         });
//     } catch (error) {
//         console.error("Error al cargar el archivo JSON: ", error);
//     }
// }

async function cargarTiposC() {
    try {
        // Cargar el archivo JSON
        const response = await fetch('/data/tipo_cotizacion.json');
        const data = await response.json(); // Parsear el JSON

        // Obtener el elemento select
        const selectElement = document.getElementById("worker_type");
        const salarioInput = document.getElementById("salary"); // Asegúrate de que este sea el id de tu campo de salario

        // Arreglo de tipos de cotizantes con salario 0
        const tiposConSalarioCero = [12, 19, 21, 42]; // IDs de los tipos con salario 0

        // Agregar las opciones dinámicamente al select
        data.forEach(item => {
            const option = document.createElement("option");
            option.value = item.id;
            option.textContent = item.description;
            selectElement.appendChild(option);
        });

        // Agregar un evento de cambio para la selección del tipo de cotizante
        selectElement.addEventListener('change', () => verificarSalario(tiposConSalarioCero, selectElement, salarioInput));
        // Agregar un evento al campo de salario para verificar cuando el campo pierde el foco
        salarioInput.addEventListener('blur', () => verificarSalario(tiposConSalarioCero, selectElement, salarioInput));

    } catch (error) {
        console.error("Error al cargar el archivo JSON: ", error);
    }
}

function verificarSalario(tiposConSalarioCero, selectElement, salarioInput) {
    const tipoCotizanteId = parseInt(selectElement.value); // ID del tipo de cotizante seleccionado
    const salario = parseFloat(salarioInput.value); // Valor del salario ingresado

    // Verificamos si el tipo de cotizante tiene salario 0 y el salario no es 0
    if (tiposConSalarioCero.includes(tipoCotizanteId) && salario !== 0) {
        alert('¡Error! Los cotizantes de este tipo deben tener un salario de 0.');
        selectElement.value = ''; // Restablecer a un valor por defecto, por ejemplo, vacío
        // Si deseas que se vuelva a 'Dependiente', puedes buscar el id correspondiente y asignarlo
        const dependienteOption = Array.from(selectElement.options).find(option => option.textContent.includes('Dependiente'));
        if (dependienteOption) {
            selectElement.value = dependienteOption.value;
        }
    }
}

// Llamar a la función para cargar los tipos de cotizantes cuando cargue la página
document.addEventListener('DOMContentLoaded', cargarTiposC);



// Llamar a la función para cargar los municipios al cargar la página
cargarMunicipios();
// cargarTiposC();
