const points=document.querySelector('#points');
const itemdisplayer=document.querySelector('#carddisplayer');


const makeitemcards=item=>{
    const outerdiv=document.createElement('div');
    outerdiv.className='col-6 col-md-3';
    itemdisplayer.append(outerdiv);
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
    const borrowlistbody=document.createElement('ul');
    borrowlistbody.className='list-group list-group-flush';
    carddiv.append(borrowlistbody);
    console.log(item.id);
    fetch('/MyLoc/borrowEndPoints.php?iditem='+item.id).
        then(response=>response.json()).
        then(data=>data.forEach(borrow=>{
            const borrowinfo=document.createElement('li');
            borrowinfo.className='list-group-item';
            console.log('start= '+borrow.start);
            borrowinfo.innerText='Début: '+borrow.start+' Fin: '+borrow.end;
            borrowlistbody.append(borrowinfo);
        }))
        .catch(error=>console.error(error));
    suppressionbutton=document.createElement('button');
    suppressionbutton.innerText="Supprimer l'objet";
    suppressionbutton.className='btn btn-primary';
    suppressionbutton.addEventListener('click',()=>{
        if (confirm('Voulez vous vraiment supprimer cet objet')) {
            window.location.href = 'index.php?target=deleteitem&iditem='+item.id;
          }
    });
    carddiv.append(suppressionbutton);
    updatebutton=document.createElement('a');
    updatebutton.innerText="Mettre a jour";
    updatebutton.className='btn btn-primary mt-1';
    updatebutton.href='index.php?target=updateitem&iditem='+item.id;
    carddiv.append(updatebutton);
}


fetch('/myLoc/itemEndPoints.php?filter=myself').
    then(response=>response.json()).
    then(data=>data.forEach(item=>makeitemcards(item)))

fetch('userEndPoints.php?points=true').
    then(response=>response.json()).
    then(data=>points.innerText='Points:'+data.points);