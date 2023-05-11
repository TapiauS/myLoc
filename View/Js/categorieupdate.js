const catname=document.querySelector('#updatename');
const points=document.querySelector('#updatepoints');
const catlist=document.querySelector('#catlist');
const formupdate=document.querySelector('#updateform');
const cats=[];

fetch('/MyLoc/categorieEndPoints.php').
    then(response=>response.json()).
    then(data=>{
        data.forEach(cat=>
        {
            const option=document.createElement('option');
            cats.push(cat);
            option.value=cat.id;
            option.innerHTML=cat.name;
            catlist.appendChild(option);
        }
    )});



catlist.addEventListener('click',()=>{
    console.log(cats);
    cats.forEach(cat=>{
        console.log(cat.id===parseInt(catlist.value));
        if(cat.id===parseInt(catlist.value)){
            catname.value=cat.name;
            points.value=cat.points;
            return;
        }
    })
})