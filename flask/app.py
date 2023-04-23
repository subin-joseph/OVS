from flask import Flask, request
from textblob import TextBlob
import cv2
import numpy as np
app = Flask(__name__)

@app.route('/detect_faces', methods=['POST'])
def detect_faces():
    # Get image file from request
    image_file = request.files['image']
    image = np.frombuffer(image_file.read(), np.uint8)

    # Load image using OpenCV
    image = cv2.imdecode(image, cv2.IMREAD_UNCHANGED)
    # Use OpenCV's face detection to count number of faces
    face_cascade = cv2.CascadeClassifier('Lib/site-packages/cv2/data/haarcascade_frontalface_alt.xml')
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    faces = face_cascade.detectMultiScale(gray, scaleFactor=1.1, minNeighbors=2)
    num_faces = len(faces)

    # Return number of faces in JSON format
    return {'num_faces': num_faces}

@app.route('/sentiment', methods=['POST'])
def sentiment_analysis():
   texts = request.json.get('texts')
   sentiment_scores = []
   for text in texts:
        blob = TextBlob(text)
        sentiment = blob.sentiment.polarity
        sentiment_scores.append(sentiment)
   average_sentiment = sum(sentiment_scores) / len(sentiment_scores)
   response = {
        'positive': len([s for s in sentiment_scores if s > 0]),
        'negative': len([s for s in sentiment_scores if s < 0]),
        'neutral': len([s for s in sentiment_scores if s == 0]),
        'average_sentiment': average_sentiment
    }
   return response 


if __name__ == '__main__':
    app.run()
