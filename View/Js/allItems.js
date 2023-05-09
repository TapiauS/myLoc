const displayer=document.querySelector('#allitems');
const categorieselector=document.querySelector('#categoriedropdown');
const catlist=document.querySelector('#catlist');
let categories;
let items;
let connected=false;

fetch('/coursPHP/Myloc/isconnected.php').
    then(response=>response.json).
    then(json=>connected=json.connected);



const itemdisplayer=item=>{
    const outerdiv=document.createElement('div');
    outerdiv.className='col-6 col-md-3';
    displayer.appendChild(outerdiv);
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
    fetch('/coursPHP/MyLoc/borrowEndPoints.php?iditem='+item.id).
        then(response=>response.json).
        then(json=>json.forEach(borrow=>{
            const borrowinfo=document.createElement('li');
            borrowinfo.className='list-group-item';
            borrowinfo.innerText='Début: '+borrow.start+' Fin: '+borrow.end;
            borrowlistbody.append('borrowinfo');
        }))
        .catch(error=>console.error(error));
    if(connected){
        const button=document.createElement('button');
        button.addEventListener('click',()=>{
            window.location.href='/coursPHP/MyLoc/index.php?target=borrow&iditem='+item.id;
        })
    }
}

fetch('/coursPHP/itemEndPoints.php').
    then(response=>response.json).
    then(json=>json.forEach(
        cat=>{
            const option=document.createElement('option');
            option.value=cat.name;
            option.innerHTML=cat.name;
            categorieselector.appendChild(option);
        }
    ))


fetch('/coursPHP/MyLoc/itemEndPoints.php').
    then(response=>response.json).
    then(json=>{
        items=json;
        json.forEach(item => itemdisplayer(item))
    });

categorieselector.addEventListener('onchange',()=>{
    displayer.innerHTML='';
    if(categorieselector.value!='')
        items.forEach(item => {
            if(categorieselector.value===item.categorie)
                itemdisplayer(item);
        });
    else
        items.forEach(
            item=>itemdisplayer(item)
        )
})



