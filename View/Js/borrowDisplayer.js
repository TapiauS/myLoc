const allborrow=document.querySelector('#allborrow');

const itemdisplayer=(item,containerdiv)=>{
    const carddiv=document.createElement('div');
    carddiv.className='card';
    containerdiv.appendChild(carddiv);
    const itemimage=document.createElement('img');
    itemimage.className='card-img-top';
    itemimage.alt='Image de '+item.name;
    itemimage.src='Images/'+item.picture;
    carddiv.append(itemimage);
    const itemname=document.createElement('h5');
    itemname.className='card-title';
    itemname.innerText='Nom:'+item.name;
    carddiv.appendChild(itemname);
    const description=document.createElement('p');
    description.className='card-body';
    description.innerText='Description:'+item.description;
    carddiv.appendChild(description);
}

fetch('borrowEndPoints.php').
    then(response=>response.json()).
    then(data=>{
        data.forEach(borrow => {
        const outerdiv=document.createElement('div');
        outerdiv.className='col-6 col-md-3';
        allborrow.appendChild(outerdiv);
        const outerborrowdiv=document.createElement('div');
        outerborrowdiv.className='row';
        outerdiv.appendChild(outerborrowdiv);
        const startdate=document.createElement('div');
        startdate.className='col-6';
        startdate.innerText='Début: '+borrow.start;
        outerborrowdiv.appendChild(startdate);
        const enddate=document.createElement('div');
        enddate.className='col-6';
        enddate.innerText='Fin: '+borrow.end;
        outerborrowdiv.appendChild(enddate);
        const outeritemdiv=document.createElement('div');
        outeritemdiv.className='col-12';
        outerborrowdiv.append(outeritemdiv);
        const itemdiv=document.createElement('div');
        itemdiv.className='row';
        itemdisplayer(borrow.item,itemdiv);
        outeritemdiv.appendChild(itemdiv);
        const deleteButton=document.createElement('button');
        if(!(Date.parse(borrow.start)<Date.now()&&Date.now()<Date.parse(borrow.end)))
        {
            deleteButton.className='btn btn-primary';
            deleteButton.innerText='Supprimer la reservation';
            deleteButton.addEventListener('click',()=>{
                if(confirm('VOulez vous vraiment supprimer cet emprunt')){
                    window.location.href='index.php?target=deleteborrow&idborrow='+borrow.id;
                }
            })
            outerborrowdiv.appendChild(deleteButton);
        }
    })
    });