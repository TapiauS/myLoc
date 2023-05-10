const itemdisplayer=document.querySelector('#carddisplayer');


const makeitemcards=item=>{
    const outerdiv=document.createElement('div');
    outerdiv.className='col-6 col-md-3';
    displayer.appendChild(itemdisplayer);
    const carddiv=document.createElement('div');
    carddiv.className='card';
    outerdiv.appendChild(carddiv);
    const listbody=document.createElement('ul');
    listbody.className='list-group list-group-flush';
    carddiv.appendChild(listbody);
    const itemname=document.createElement('li');
    itemname.className='list-group-item';
    itemname.innerText='Nom:'+item.name;
    listbody.appendChild(itemname);
    const description=document.createElement('li');
    itemname.className='list-group-item';
    itemname.innerText='Description:'+item.description;
    listbody.appendChild(description);
    const borrowlistbody=document.createElement('ul');
    borrowlistbody.className='list-group list-group-flush';
    carddiv.appendChild(borrowlistbody);
    fetch('/myLoc/MyLoc/borrowEndPoints.php?iditem='+item.id).
        then(response=>response.json()).
        then(data=>data.forEach(borrow=>{
            const borrowinfo=document.createElement('li');
            borrowinfo.className='list-group-item';
            borrowinfo.innerText='Début: '+borrow.start+' Fin: '+borrow.end;
            borrowlistbody.append('borrowinfo');
        }))
        .catch(error=>console.error(error));
    if(connected){
        const button=document.createElement('button');
        button.addEventListener('click',()=>{
            window.location.href='/myLoc/MyLoc/index.php?target=borrow&iditem='+item.id;
        })
    }
}
