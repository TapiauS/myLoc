const itemname=document.querySelector('#item_name');
const description=document.querySelector('#description');
const itemtype=document.querySelector('#item_type');
const picture=document.querySelector('#picture');
const pictureselector=document.querySelector('#item_image');
const defaulttypeoption=document.querySelector('#default');
const params = new URLSearchParams(window.location.search);
const form=document.querySelector('form');
const iditem = params.get('iditem');


fetch('itemEndPoints.php?filter=oneitem&iditem='+iditem).
    then(response=>response.json()).
    then(data=>{
        itemname.value=data[0].name;
        description.value=data[0].description;
        defaulttypeoption.value=data[0].categorie.id;
        picture.src='Images/'+data[0].picture;
        defaulttypeoption.innerHTML=data[0].categorie.name;
    }).
    then(fetch('/MyLoc/categorieEndPoints.php').
        then(response=>response.json()).
        then(data=>{
            data.forEach(cat=>{
                console.log(defaulttypeoption.value);
                console.log(cat.id);
                if(parseInt(cat.id)!==parseInt(defaulttypeoption.value))
                {
                    const option=document.createElement('option');
                    option.value=cat.name;
                    option.innerHTML=cat.name;
                    itemtype.appendChild(option);
                }
            }
    )}));



pictureselector.addEventListener('change',event=>{
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.addEventListener('load', event => {
        picture.src=event.target.result
    });
    reader.readAsDataURL(file);
});


form.addEventListener('submit',event=>{
    event.preventDefault;
    success=namefield.value!==''&&catlist.value!=='';
    if(success)
        HTMLFormElement.prototype.submit.call(form);
    else
        alert('Le nom ne peut pas être vide et la catégorie doit être sélectionée') 
})




