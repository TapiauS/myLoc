const displayer=document.querySelector('#itemdisplayer');
const categorieselector=document.querySelector('#catlist');
const catlist=document.querySelector('#catlist');
let categories;
let items;
let connected=false;

fetch('/Myloc/isconnected.php').
    then(response=>response.json()).
    then(data=>connected=data.connected);



const itemdisplayer=item=>{
    const outerdiv=document.createElement('div');
    outerdiv.className='col-6 col-md-3';
    displayer.append(outerdiv);
    const carddiv=document.createElement('div');
    carddiv.className='card';
    outerdiv.append(carddiv);
    const listbody=document.createElement('div');
    listbody.className='card-body';
    carddiv.append(listbody);
    const itemimage=document.createElement('img');
    itemimage.className='card-img-top';
    itemimage.alt='Image de '+item.name;
    itemimage.src='Images/'+item.picture;
    carddiv.append(itemimage);
    const itemname=document.createElement('h5');
    itemname.className='card-title';
    itemname.innerText='Nom:'+item.name;
    listbody.append(itemname);
    const description=document.createElement('p');
    description.className='card-text';
    description.innerText='Description:'+item.description;
    listbody.append(description);
    const ownerdiv=document.createElement('p');
    ownerdiv.className='card-text';
    ownerdiv.innerText='Propriétaire : '+item.owner.pseudo;
    listbody.append(ownerdiv);
    const borrowlistbody=document.createElement('ul');
    borrowlistbody.className='list-group list-group-flush';
    carddiv.append(borrowlistbody);
    fetch('/MyLoc/borrowEndPoints.php?iditem='+item.id).
        then(response=>response.json()).
        then(data=>data.forEach(borrow=>{
            const borrowinfo=document.createElement('li');
            borrowinfo.className='list-group-item';
            borrowinfo.innerText='Début: '+borrow.start+' Fin: '+borrow.end;
            borrowlistbody.append(borrowinfo);
        }))
        .catch(error=>console.error(error));
    if(connected){
        const button=document.createElement('button');
        button.addEventListener('click',()=>{
            window.location.href='/MyLoc/index.php?target=borrow&iditem='+item.id;
        });
        button.className="btn btn-primary";
        button.innerText='Reserver';
        carddiv.append(button);
    }
}

fetch('/MyLoc/categorieEndPoints.php').
    then(response=>response.json()).
    then(data=>{
        data.forEach(cat=>
        {
            const option=document.createElement('option');
            option.value=cat.name;
            option.innerHTML=cat.name;
            categorieselector.append(option);
        }
    )});


fetch('/MyLoc/itemEndPoints.php').
    then(response=>response.json()).
    then(data=>{
        items=data;
        data.forEach(item => itemdisplayer(item))
    });

categorieselector.addEventListener('click',()=>{
    displayer.innerHTML='';
    if(categorieselector.value!='')
        items.forEach(item => {
            if(categorieselector.value===item.categorie.name)
                itemdisplayer(item);
        });
    else
        items.forEach(
            item=>itemdisplayer(item)
        )
})



