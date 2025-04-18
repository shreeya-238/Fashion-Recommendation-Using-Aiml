#!/usr/bin/env python
# coding: utf-8

# In[6]:


from flask import Flask, request, jsonify
import pickle
import numpy as np
import tensorflow
from tensorflow.keras.preprocessing import image
from tensorflow.keras.applications.resnet50 import ResNet50, preprocess_input
from tensorflow.keras.layers import GlobalMaxPooling2D
from sklearn.neighbors import NearestNeighbors
from numpy.linalg import norm

app = Flask(__name__)

# Load pre-saved model and feature list
feature_list = np.array(pickle.load(open('embeddings.pkl', 'rb')))
filenames = pickle.load(open('filenames.pkl', 'rb'))

# Recreate the model
model = ResNet50(weights='imagenet', include_top=False, input_shape=(224, 224, 3))
model.trainable = False
model = tensorflow.keras.Sequential([model, GlobalMaxPooling2D()])

# Set up KNN
neighbors = NearestNeighbors(n_neighbors=4, algorithm='brute', metric='euclidean')
neighbors.fit(feature_list)

# API route to get recommendations
@app.route('/recommend', methods=['POST'])
def recommend():
    # Get the image file from the request
    img_file = request.files['image']
    
    # Process the image
    img = image.load_img(img_file, target_size=(224, 224))
    img_array = image.img_to_array(img)
    expanded_img_array = np.expand_dims(img_array, axis=0)
    preprocessed_img = preprocess_input(expanded_img_array)
    
    # Extract features
    result = model.predict(preprocessed_img).flatten()
    normalized_result = result / norm(result)
    
    # Get recommendations
    distances, indices = neighbors.kneighbors([normalized_result])
    
    # Get filenames of recommended items
    recommended_files = [filenames[file] for file in indices[0]]
    
    return jsonify({"recommended_files": recommended_files})

if __name__ == '__main__':
    app.run(debug=True)


# In[ ]:





# In[ ]:




