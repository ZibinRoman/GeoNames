async function getId(){
	const id = document.getElementById("id").value;
	const response = await fetch('../api/read_single.php', {
		method: "POST",
		headers: {
			'Content-Type': 'application/json;charset=utf-8'
		  },
		body: JSON.stringify({ id: id})
	});
	//451747
	//console.log(response);http://geonames/
	const data = await response.json();
	//console.log(data.geonameid);
	renderCity(data, 1);
}

async function getCount(){
	const count = document.getElementById("count").value;
	const response = await fetch('../api/read_count.php', {
		method: "POST",
		headers: {
			'Content-Type': 'application/json;charset=utf-8'
		  },
		body: JSON.stringify({ count: count})
	});
	//console.log(response);
	const data = await response.json();
	console.log(data);
	data.forEach(element => {
		renderCity(element, 2);
	});
}

async function getCity(){
	const city1 = document.getElementById("city1").value;
	const city2 = document.getElementById("city2").value;
	const response = await fetch('../api/read_name.php', {
		method: "POST",
		headers: {
			'Content-Type': 'application/json;charset=utf-8'
		}, 
		body: JSON.stringify({ city1: city1, city2: city2})
	});
	//console.log(response);
	const data = await response.json();
	//console.log(data);
	render(data);
}

async function render(data) {
	renderCity(data['city1'], 3);
	renderCity(data['city2'], 3);
	document.querySelector(`.card-list-3`).innerHTML += `
		<p>${data.response1}</p>
		</br>
		<p>${data.response2}</p>
	`;
}

async function renderCity(data, i) {
    document.querySelector(`.card-list-${i}`).innerHTML += `
            <div class="card">
				<div class="card-body">
					<table>
						<tr>
							<th>geonameid</th>
							<th>name</th>
							<th>asciiname</th>
							<th>alternatenames</th>
							<th>latitude</th>
							<th>longitude</th>
							<th>feature class</th>
							<th>feature code</th>
							<th>country code</th>
							<th>cc2</th>
							<th>admin1 code</th>
							<th>admin2 code</th>
							<th>admin3 code</th>
							<th>admin4 code</th>
							<th>population</th>
							<th>elevation</th>
							<th>dem</th>
							<th>timezone</th>
							<th>modification date</th>
						</tr>
						<tr>
							<th>${data.geonameid}</th>
							<th>${data.name}</th>
							<th>${data.asciiname}</th>
							<th>${data.alternatenames}</th>
							<th>${data.latitude}</th>
							<th>${data.longitude}</th>
							<th>${data.feature_class}</th>
							<th>${data.feature_code}</th>
							<th>${data.country_code}</th>
							<th>${data.cc2}</th>
							<th>${data.admin1_code}</th>
							<th>${data.admin2_code}</th>
							<th>${data.admin3_code}</th>
							<th>${data.admin4_code}</th>
							<th>${data.population}</th>
							<th>${data.elevation}</th>
							<th>${data.dem}</th>
							<th>${data.timezone}</th>
							<th>${data.modification_date}</th>
						</tr>
					</table>
				</div>
			</div>
        `;
}
 