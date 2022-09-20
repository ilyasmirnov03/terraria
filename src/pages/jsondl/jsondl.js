document.addEventListener('DOMContentLoaded', function () {

    let json = {
        items: []
    };

    class item {
        constructor(id, name, internalName) {
            this.id = id;
            this.name = name;
            this.internalName = internalName;
        }
    };

    document.querySelector('#prepare').addEventListener('click', function () {
        fetch('terraria.php')
            .then(data => {
                return data.text()
            })
            .then(data => {
                let start = data.split('<table', 2).join('<table').length;
                let end = data.split('</table>', 2).join('</table>').length;
                document.getElementById('code').innerHTML = data.substring(start, end);
            })
            .then(() => {
                document.querySelectorAll('tr:not(:first-child)').forEach(cell => {
                    let newItem = new item(
                        cell.querySelector(':first-child').textContent,
                        cell.querySelector(':nth-child(2)').textContent,
                        cell.querySelector(':nth-child(3)').textContent
                    );
                    json.items.push(newItem);
                });
            }).finally(() => {
                const file = new Blob(
                    [JSON.stringify(json)],
                    { type: 'application/json' }
                );
                const fileURL = URL.createObjectURL(file);
                document.querySelector('body>a').setAttribute('href', fileURL);
                document.querySelector('body>a').style.display = 'inline';
            })
    });

}); 