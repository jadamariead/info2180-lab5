document.addEventListener('DOMContentLoaded', function() {
     const lookupBtn = document.getElementById('lookup');
     const country = document.getElementById('country');
     const result = document.getElementById('result');

     lookupBtn.addEventListener('click', function() {
          const countryName = country.value;
          const xhr = new XMLHttpRequest();

          xhr.open('GET', `world.php?country=${encodeURIComponent(countryName)}`, true);
          
          xhr.onreadystatechange = function() {
               if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                         let response = xhr.responseText;
                         resultDiv.innerHTML = '';
                    } else {
                         resultDiv.textContent = 'Error fetching data.';
                    }
               }
          }

          xhr.send();
     });
});