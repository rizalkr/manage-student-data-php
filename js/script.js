// Jquery Version
// $(document).ready(() => {
//     $('#keyword').on('keyup', () => {
//         $('#container').load('./ajax/mahasiswa.php?keyword' + $('#keyword').val())
//     })
// })



// Js Native / Js Vanilla Version

const keyword = document.getElementById('keyword')
let table = document.getElementById('table')

keyword.addEventListener('keyup', () => {
    const xhr = new XMLHttpRequest()

    xhr.onreadystatechange = () => {
        if( xhr.readyState == 4 && xhr.status == 200){
            table.innerHTML = xhr.responseText
        }
    }
    xhr.open('GET', './ajax/mahasiswa.php?keyword=' + keyword.value, true)
    xhr.send()
})