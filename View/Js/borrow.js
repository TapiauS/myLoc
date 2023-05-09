const start=document.querySelector('#start');
const end=document.querySelector('#end');
const form=document.querySelector('form');

form.addEventListener('submit',event=>{
    event.preventDefault;
    const startdate=new Date(start.value);
    const enddate=new Date(end.value);
    let success=(startdate-enddate)<0;
    if(success){
        const formData = new FormData(form);
        fetch(form.action, {
          method: form.method,
          body: formData
        }).
        then(response=>response.json).
        then(json=>{
            if(json.success==false&&json.code==='notavailable')
                alert('Objet non disponible à cette date');
        }).
        catch(error=>console.log(error.message));
    }
    else{
        alert('La date de début doit être antérieur à la date de fin');
    }
})