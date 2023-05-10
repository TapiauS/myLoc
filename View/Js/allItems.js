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
    const listbody=document.createElement('ul');
    listbody.className='list-group list-group-flush';
    carddiv.append(listbody);
    const itemname=document.createElement('li');
    itemname.className='list-group-item';
    itemname.innerText='Nom:'+item.name;
    console.log(itemname);
    listbody.append(itemname);
    const description=document.createElement('li');
    itemname.className='list-group-item';
    itemname.innerText='Description:'+item.description;
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
            borrowinfo.innerText='Début: '+borrow.start+' Fin: '+borrow.end;
            borrowlistbody.append('borrowinfo');
        }))
        .catch(error=>console.error(error));
    if(connected){
        const button=document.createElement('button');
        button.addEventListener('click',()=>{
            window.location.href='/MyLoc/index.php?target=borrow&iditem='+item.id;
        })
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



