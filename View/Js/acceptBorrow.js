const waitingborrow=document.querySelector('#waitingborrows');

fetch('borrowEndPoints.php?you=true').
    then(response=>response.json()).
    then(data=>{
        data.forEach(borrow => {
            if(!borrow.accepted){
                const containerdiv=document.createElement('div');
                containerdiv.className="col-6 col-md-3";
                waitingborrow.append(containerdiv);
                const infoparagraph=document.createElement('p');
                infoparagraph.innerText='Objet:'+borrow.item.name+" Début:"+borrow.start+" Fin:"+borrow.end+" Emprunteur:"+borrow.borrower.pseudo;
                containerdiv.append(infoparagraph);
                const validationbutton=document.createElement('a');
                validationbutton.href='index.php?target=validateborrow&idborrow='+borrow.id+"&iditem="+borrow.item.id;
                validationbutton.className='btn btn-primary';
                validationbutton.innerText='Accepter';
                containerdiv.append(validationbutton);
                const refusebutton=document.createElement('a');
                refusebutton.href='index.php?target=refuseborrow&idborrow='+borrow.id+"&iditem="+borrow.item.id;
                refusebutton.className='btn btn-secondary';
                refusebutton.innerText='Refuser';
                containerdiv.append(refusebutton);
            }
        });
    })