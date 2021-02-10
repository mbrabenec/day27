
function attend() {

    fetch('https://classes.codingbootcamp.cz/api/attendance/coding-bootcamp/winter-2021/2021-02-09')
        .then(response => {
            return response.json();
        })
        .then(data => {

            let people = data.attendance;
            let listContents = document.getElementById("the-list");

            for (let i = 0; i < people.length; i++) {
                if(people[i].from !== null) {
                    listContents.innerHTML += `<li>${people[i].name}</li>`;
                }
            }
        

        });

}



attend();