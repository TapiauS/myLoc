const start=document.querySelector('#start');
const end=document.querySelector('#end');
const form=document.querySelector('form');
const params = new URLSearchParams(window.location.search);
const iditem = params.get('iditem');
form.action+='&iditem='+iditem;

form.addEventListener('submit',event=>{
    event.preventDefault();
    const startdate=new Date(start.value);
    const enddate=new Date(end.value);
    let success=(startdate-enddate)<0;
    if(success){
        const formData = new FormData(form);
        fetch(form.action, {
          method: form.method,
          body: formData
        }).
        then(response=>response.json()).
        then(data=>{
            console.log(data);
            if(!data.success){
                switch(data.code){
                    case 'notavailable':
                        alert('Objet non disponible à cette date');
                        break;
                    case 'default':
                        alert('Erreur de saisie inconnue');
                        break;
                }
            }
            else if(data.success){
                alert('Location effectuée');
                window.location.href='index.php';
            }
        }).
        catch(error=>console.log(error.message)).
        finally()

    }
    else{
        alert('La date de début doit être antérieur à la date de fin');
    }
})