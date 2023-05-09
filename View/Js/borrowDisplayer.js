const allborrow=document.querySelector('#allborrow');

const itemdisplayer=(item,containerdiv)=>{
    const outerdiv=document.createElement('div');
    outerdiv.className='col-6 col-md-3';
    containerdiv.appendChild(outerdiv);
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
}

fetch('CoursPHP/myloc/borrowEndPoints.php').
    then(response=>response.json).
    then(json=>json.forEach(borrow => {
        const outerdiv=document.createElement('div');
        outerdiv.className='col-6 col-md-3';
        allborrow.appendChild(outerdiv);
        const datediv=document.createElement('div');
        datediv.className='row';
        outerdiv.appendChild(datediv);
        const startdate=document.createElement('div');
        startdate.className('col-6');
        startdate.innerText='Début: '+borrow.start;
        datediv.appendChild(startdate);
        const enddate=document.createElement('div');
        enddate.className('col-6');
        enddate.innerText='Début: '+borrow.end;
        datediv.appendChild(startend);
        const itemdiv=document.createElement('div');
        itemdiv.className='row';
        itemdisplayer(borrow.item,itemdiv);
        outerdiv.appendChild(itemdiv);
    })
    ).
    catch();