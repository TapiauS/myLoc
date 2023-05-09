const categoriesdisplayer=document.querySelector('#categoriesdisplay');
const userdisplayer=document.querySelector('#userdisplay');

fetch('/coursPHP/MyLoc/userEndPoints.php').
    then(response=>response.json).
    then(json=>json.forEach(user => {
        const outerdiv=document.createElement('div');
        outerdiv.className='col-6 col-md-3';
        const carddiv=document.createElement('div');
        carddiv.className='card';
        outerdiv.appendChild(carddiv);
        const listbody=document.createElement('ul');
        listbody.className='list-group list-group-flush';
        carddiv.appendChild(listbody);
        const userpseudo=document.createElement('li');
        userpseudo.className='list-group-item';
        userpseudo.innerText='Pseudo:'+user.pseudo;
        carddiv.appendChild(userpseudo);
        const useradress=document.createElement('li');
        useradress.className='list-group-item';
        useradress.innerText='Adress:'+user.town+","+user.adress;
        carddiv.appendChild(useradress);
        const userpoints=document.createElement('li');
        userpoints.className='list-group-item';
        useradress.innerText='Points: '+user.points;
        const updateButton=document.createElement('button');
        updateButton.innerText='Update';
        updateButton.addEventListener('click',()=>{
            window.location.href='/coursPHP/MyLoc/index.php?target=updateaccount&idaccount='+user.id;
        });
    }));

fetch('/coursPHP/MyLoc/categoriesEndPoints.php').
    then(response=>response.json).
    then(json=>json.forEach(categories => {
        const outerdiv=document.createElement('div');
        outerdiv.className='col-6 col-md-3';
        const carddiv=document.createElement('div');
        carddiv.className='card';
        outerdiv.appendChild(carddiv);
        const listbody=document.createElement('ul');
        listbody.className='list-group list-group-flush';
        carddiv.appendChild(listbody);
        const name=document.createElement('li');
        name.className='list-group-item';
        name.innerText='Pseudo:'+categories.name;
        carddiv.appendChild(userpseudo);
        const useradress=document.createElement('li');
        points.className='list-group-item';
        points.innerText='Points associés:'+categories.points;
        carddiv.appendChild(useradress);
    }))


