const btnEl = document.getElementById("btn");
const par = document.getElementById("joke");
const apiUrl = "https://api.api-ninjas.com/v1/dadjokes?limit=1";
btnEl.onclick= async function(){
    par.innerText="Updating...";
const response = await fetch(apiUrl,options);
const data = await response.json();
par.innerText = data[0].joke;
console.log(data[0].joke);
};
const apiKey = "Ps8Y0gWw+Qci9XbY0sYhxQ==sPgVfSo6bPwpu4Jy";
const options = {
    method: "GET",
    headers: { 'X-Api-Key': apiKey,
},
};
