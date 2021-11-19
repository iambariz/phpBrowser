const main = document.querySelector(".main");

array.forEach((element) => {
	main.innerHTML += `
    <tr>
        <td>${element[3]}</td>
        <td>${element[2]}</td>
        <td>${element[0]}</th>
    </tr>
`;
});
