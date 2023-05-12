const catlist=document.querySelector('#item_type');
const namefield=document.querySelector('#item_name');
const descriptionfirld=document.querySelector('#description');

const form=document.querySelector('form');

fetch('/MyLoc/categorieEndPoints.php').
    then(response=>response.json()).
    then(data=>{
        data.forEach(cat=>
        {
            const option=document.createElement('option');
            option.value=cat.name;
            option.innerHTML=cat.name;
            catlist.appendChild(option);
        }
    )});

form.addEventListener('submit',event=>{
    event.preventDefault;
    success=namefield.value!==''&&catlist.value!=='';
    if(success)
        HTMLFormElement.prototype.submit.call(form);
    else
        alert('Le nom ne peut pas être vide et la catégorie doit être sélectionée') 
})

