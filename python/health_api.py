import requests

url = "https://exercisedb.p.rapidapi.com/exercises"

headers = {
	"X-RapidAPI-Key": "bf081435aamsh6bd23e7e1a73b9ep10333cjsna1d042fa1e22",
	"X-RapidAPI-Host": "exercisedb.p.rapidapi.com"
}

response = requests.get(url, headers=headers)

print(response.json())