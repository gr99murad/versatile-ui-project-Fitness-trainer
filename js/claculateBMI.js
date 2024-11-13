document.getElementById('bmi-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    // Get input values
    let height = parseFloat(document.getElementById('height').value) / 100; // Convert cm to meters
    let weight = parseFloat(document.getElementById('weight').value);
    let bmi = weight / (height * height); 
    
    
    bmi = bmi.toFixed(2);

    // Display the BMI result
    document.getElementById('bmi-value').textContent = bmi;

    //  BMI category
    let bmiStatus = '';
    if (bmi < 18.5) {
        bmiStatus = 'Underweight';
    } else if (bmi >= 18.5 && bmi < 24.9) {
        bmiStatus = 'Healthy';
    } else if (bmi >= 25.0 && bmi < 29.9) {
        bmiStatus = 'Overweight';
    } else {
        bmiStatus = 'Obese';
    }

    // Display the BMI status
    document.getElementById('bmi-status').textContent = `You are ${bmiStatus}.`;

    // Show the result section
    document.getElementById('bmi-result').style.display = 'block';
});
