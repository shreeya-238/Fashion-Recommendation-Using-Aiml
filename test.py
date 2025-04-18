from flask import Flask, request, jsonify
from flask_cors import CORS
import pickle
import numpy as np
from tensorflow.keras.preprocessing import image
from tensorflow.keras.applications.resnet50 import ResNet50, preprocess_input
from tensorflow.keras.layers import GlobalMaxPooling2D
from sklearn.neighbors import NearestNeighbors
from numpy.linalg import norm
import tensorflow
import threading
import os
from werkzeug.serving import run_simple

# Initialize Flask app
app = Flask(__name__)
CORS(app)  # Enable CORS for frontend connection

# Load pre-saved feature list and filenames
feature_list = np.array(pickle.load(open('embeddings.pkl', 'rb')))
filenames = pickle.load(open('filenames.pkl', 'rb'))

# Load ResNet50 model
model = ResNet50(weights='imagenet', include_top=False, input_shape=(224, 224, 3))
model.trainable = False
model = tensorflow.keras.Sequential([model, GlobalMaxPooling2D()])

# Function to extract features from an image
def extract_features(img_path):
    img = image.load_img(img_path, target_size=(224, 224))
    img_array = image.img_to_array(img)
    expanded_img_array = np.expand_dims(img_array, axis=0)
    preprocessed_img = preprocess_input(expanded_img_array)

    result = model.predict(preprocessed_img).flatten()
    normalized_result = result / norm(result)  # Normalize
    return normalized_result

# Function to get recommendations
def get_recommendations(normalized_result):
    neighbors = NearestNeighbors(n_neighbors=4, algorithm='brute', metric='euclidean')
    neighbors.fit(feature_list)
    distances, indices = neighbors.kneighbors([normalized_result])
    recommended_files = [os.path.basename(filenames[file]) for file in indices[0]]
    return recommended_files
# Define API route
@app.route('/recommend', methods=['POST'])
def recommend():
    img_file = request.files['image']
    img_path = 'temp_image.jpg'
    img_file.save(img_path)

    normalized_result = extract_features(img_path)
    recommended_files = get_recommendations(normalized_result)

    # Extract just filenames like "1163.jpg"
    recommended_files = [os.path.basename(file) for file in recommended_files]

    print("Recommended files:", recommended_files)
    print("Final Recommended Filenames:", recommended_files)
    return jsonify({"recommended_files": recommended_files})

# Run Flask in a separate thread inside Jupyter
def run_app():
    run_simple("0.0.0.0", 5000, app, use_reloader=False)

thread = threading.Thread(target=run_app)
thread.start()
