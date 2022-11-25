from flask import Flask,render_template, request
from flask_cors import cross_origin
import requests
import pandas as pd
import pickle

app = Flask(__name__)
# model = pickle.load(open("./models/cat1.pkl", "rb"))
# print("Model Loaded")

API_KEY = "nx0OlIK_iL58KuRVmz9S6QrtMXDJOR8pywfRzKEvFL6f"
token_response = requests.post('https://iam.cloud.ibm.com/identity/token', data={"apikey":
 API_KEY, "grant_type": 'urn:ibm:params:oauth:grant-type:apikey'})
mltoken = token_response.json()["access_token"]
header = {'Content-Type': 'application/json', 'Authorization': 'Bearer ' + mltoken}

@app.route("/",methods=['GET'])
@cross_origin()
def home():
	return render_template("index.html")

@app.route("/login",methods=['GET'])
@cross_origin()
def login():
	return render_template("login.html")

@app.route("/register",methods=['GET'])
@cross_origin()
def register():
	return render_template("register.html")

@app.route("/fb",methods=['GET'])
@cross_origin()
def feedback():
	return render_template("feedback.html")

@app.route("/predict",methods=['GET', 'POST'])
@cross_origin()
def predict():
	if request.method == "POST":
		# DATE
		date = request.form['date']
		day = float(pd.to_datetime(date, format="%Y-%m-%dT").day)
		month = float(pd.to_datetime(date, format="%Y-%m-%dT").month)
		# MinTemp
		minTemp = float(request.form['mintemp'])
		# MaxTemp
		maxTemp = float(request.form['maxtemp'])
		# Rainfall
		rainfall = float(request.form['rainfall'])
		# Evaporation
		evaporation = float(request.form['evaporation'])
		# Sunshine
		sunshine = float(request.form['sunshine'])
		# Wind Gust Speed
		windGustSpeed = float(request.form['windgustspeed'])
		# Wind Speed 9am
		windSpeed9am = float(request.form['windspeed9am'])
		# Wind Speed 3pm
		windSpeed3pm = float(request.form['windspeed3pm'])
		# Humidity 9am
		humidity9am = float(request.form['humidity9am'])
		# Humidity 3pm
		humidity3pm = float(request.form['humidity3pm'])
		# Pressure 9am
		pressure9am = float(request.form['pressure9am'])
		# Pressure 3pm
		pressure3pm = float(request.form['pressure3pm'])
		# Temperature 9am
		temp9am = float(request.form['temp9am'])
		# Temperature 3pm
		temp3pm = float(request.form['temp3pm'])
		# Cloud 9am
		cloud9am = float(request.form['cloud9am'])
		# Cloud 3pm
		cloud3pm = float(request.form['cloud3pm'])
		# Cloud 3pm
		location = float(request.form['location'])
		# Wind Dir 9am
		winddDir9am = float(request.form['winddir9am'])
		# Wind Dir 3pm
		winddDir3pm = float(request.form['winddir3pm'])
		# Wind Gust Dir
		windGustDir = float(request.form['windgustdir'])
		# Rain Today
		rainToday = float(request.form['raintoday'])
		array_of_input_fields = [location , minTemp , maxTemp , rainfall , evaporation , sunshine , windGustDir , windGustSpeed , winddDir9am , winddDir3pm , windSpeed9am , windSpeed3pm ,
        humidity9am , humidity3pm , pressure9am , pressure3pm , cloud9am , cloud3pm , temp9am , temp3pm , rainToday , month , day]; array_of_values_to_be_scored = [array_of_input_fields]
		payload_scoring = {"input_data": [{"fields": [array_of_input_fields], "values": [array_of_values_to_be_scored]}]}; response_scoring = requests.post('https://eu-gb.ml.cloud.ibm.com/ml/v4/deployments/4e23c4aa-422c-48e9-8729-2b81e019b905/predictions?version=2022-11-13', json=payload_scoring,
        headers={'Authorization': 'Bearer ' + mltoken}); predictions = response_scoring.json(); 
        #pred = predictions['predictions'][0]['values'][0][0]
		if predictions == 0:
			return render_template("after_sunny.html")
		else:
			return render_template("after_rainy.html")
	return render_template("predictor.html")

if __name__=='__main__':
	app.run(debug=True)