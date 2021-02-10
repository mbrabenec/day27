// load from API endpoint & disp in list on page

function loadMovies () {
    console.log('loading movies...')
    fetch('http://www.cbp-exercises.test/day27/ajax/api/')
    .then(response => {
        return response.json();  // parse response as json
    })
    //when entire stream of data arrives, parsed as json
    .then(data => {
        console.log(data);
        let ul = document.getElementById("list-of-movies");
        data.forEach(element => {
            ul.innerHTML += `<li>${element}</li>`;
        });

    })

}


document.getElementById("load-movies-button").addEventListener("click", loadMovies);