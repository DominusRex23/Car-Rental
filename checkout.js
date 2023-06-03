function toggleCardFields(showCardFields) {
  const ccNumField = document.getElementById('ccnum');
  const ccNumLabel = document.getElementById('ccnum-label');
  const gcashField = document.getElementById('gcash');
  const gcashLabel = document.querySelector('label[for="gcash"]');
  const expMonthField = document.getElementById('expmonth');
  const expMonthLabel = document.getElementById('expmonth-label');
  const cvvField = document.getElementById('cvv');
  const cvvLabel = document.getElementById('cvv-label');

  if (showCardFields) {
    ccNumField.style.display = 'block';
    ccNumLabel.style.display = 'block';
    gcashField.style.display = 'none';
    gcashLabel.style.display = 'none';
    expMonthField.style.display = 'block';
    expMonthLabel.style.display = 'block';
    cvvField.style.display = 'block';
    cvvLabel.style.display = 'block';
  } else {
    ccNumField.style.display = 'none';
    ccNumLabel.style.display = 'none';
    gcashField.style.display = 'block';
    gcashLabel.style.display = 'block';
    expMonthField.style.display = 'none';
    expMonthLabel.style.display = 'none';
    cvvField.style.display = 'none';
    cvvLabel.style.display = 'none';
  }
}