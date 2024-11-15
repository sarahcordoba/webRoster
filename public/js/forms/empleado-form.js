
let currentStep = 1;

function nextForm() {
    if (currentStep < 3) {
        document.getElementById('form' + currentStep).style.display = 'none';
        currentStep++;
        document.getElementById('form' + currentStep).style.display = 'block';
        updateSteps();
        document.querySelector('.progress-bar-fill').style.width = (currentStep / 3 * 100) + '%';
    }
}

function prevForm() {
    if (currentStep > 1) {
        document.getElementById('form' + currentStep).style.display = 'none';
        currentStep--;
        document.getElementById('form' + currentStep).style.display = 'block';
        updateSteps();
        document.querySelector('.progress-bar-fill').style.width = (currentStep / 3 * 100) + '%';
    }
}

function updateSteps() {
    for (let i = 1; i <= 3; i++) {
        const stepElement = document.getElementById('step' + i);
        if (i <= currentStep) {
            stepElement.classList.add('active');
        } else {
            stepElement.classList.remove('active');
        }
    }
}

// Asegúrate de que el primer formulario sea visible y el primer paso esté activo al cargar la página
window.onload = function() {
    updateSteps();
    document.getElementById('form' + currentStep).style.display = 'block'; // Mostrar el primer formulario
    document.querySelector('.progress-bar-fill').style.width = (currentStep / 3 * 100) + '%'; // Barra de progreso al 33%
};


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
            showToast('La fecha de fin de contrato debe ser posterior a la fecha de contratación.');
            contractEndDateInput.value = ''; // Clear the invalid date
        }
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const idNumberInput = document.getElementById('id_number');
    const phoneInput = document.getElementById('phone');
    const holidayInput = document.getElementById('holiday');
    const numCuentaInput = document.getElementById('numero_cuenta');

    // Permitir solo números y hasta 15 caracteres para el número de identificación
    idNumberInput.addEventListener('input', () => {
        idNumberInput.value = idNumberInput.value.replace(/[^0-9]/g, '').slice(0, 15);
    });

    // Permitir solo números y hasta 15 caracteres para el teléfono
    phoneInput.addEventListener('input', () => {
        phoneInput.value = phoneInput.value.replace(/[^0-9]/g, '').slice(0, 15);
    });

    holidayInput.addEventListener('input', () => {
        holidayInput.value = holidayInput.value.replace(/[^0-9]/g, '').slice(0, 3);
    });

    numCuentaInput.addEventListener('input', () => {
        numCuentaInput.value = numCuentaInput.value.replace(/[^0-9]/g, '').slice(0, 4);
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



async function cargarTiposC() {
    try {
        // Cargar el archivo JSON
        const response = await fetch('/data/tipo_cotizacion.json');
        const data = await response.json(); // Parsear el JSON

        // Obtener el elemento select
        const selectElement = document.getElementById("worker_type");
        const salarioInput = document.getElementById("salary"); // Asegúrate de que este sea el id de tu campo de salario

        const tiposConSalarioCero = [12, 19, 21, 42];

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

function verificarSalario(tiposConSalarioCero, tipoCotizanteId, salarioInput) {
    const salario = parseFloat(salarioInput.value); // Valor del salario ingresado

    // Verificamos si el tipo de cotizante tiene salario 0 y el salario no es 0
    if (tiposConSalarioCero.includes(tipoCotizanteId) && salario !== 0) {
        showToast('¡Error! Los cotizantes de este tipo deben tener un salario de 0.');
        selectElement.value = ''; // Restablecer a un valor por defecto, por ejemplo, vacío
        // Si deseas que se vuelva a 'Dependiente', puedes buscar el id correspondiente y asignarlo
        // const dependienteOption = Array.from(selectElement.options).find(option => option.textContent.includes('Dependiente'));
        // if (dependienteOption) {
        //     selectElement.value = dependienteOption.value;
        // }
    }
}

// Llamar a la función para cargar los tipos de cotizantes cuando cargue la página
document.addEventListener('DOMContentLoaded', cargarTiposC);
// Llamar a la función para cargar los municipios al cargar la página
cargarMunicipios();

document.addEventListener('DOMContentLoaded', function () {
    const paymentMethodSelect = document.getElementById('payment_method');
    const transferenciaInfo = document.getElementById('transferencia_info');
    paymentMethodSelect.addEventListener('change', function () {
        console.log(paymentMethodSelect.value)
        if (paymentMethodSelect.value === 'transferencia_bancaria') {
            transferenciaInfo.style.display = 'block';

        } else {
            transferenciaInfo.style.display = 'none';
        }
    });
});




