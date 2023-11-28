# print('hi')
import os
os.chdir(os.getcwd()+"/Train")

try:
    
    import sys
    import pickle
    import re
    import nltk
    from nltk.tokenize import word_tokenize
    from nltk.stem import WordNetLemmatizer
    from sklearn.feature_extraction.text import TfidfVectorizer
    import joblib

    

    # Load the saved models
    with open('tfidf_vectorizer.pkl', 'rb') as file:
        tfidf_vectorizer = pickle.load(file)

    with open('svd_transformer.pkl', 'rb') as file:
        svd_transformer = pickle.load(file)

    with open('random_forest_regressor_model.pkl', 'rb') as file:
        random_forest_model = pickle.load(file)

    # Function to clean text
    def clean_text(text):
        text = re.sub(r'<.*?>', '', text)  # Remove HTML tags
        text = re.sub(r'[^a-zA-Z\s]', '', text, re.I | re.A)  # Remove non-letters
        text = text.lower().strip()  # Lowercase and strip whitespace
        return text

    # Function to preprocess text
    def preprocess_text(text, lemmatizer, stopwords):
        tokens = word_tokenize(text)
        lemmatized = [lemmatizer.lemmatize(token) for token in tokens if token not in stopwords]
        return ' '.join(lemmatized)

    # Preprocess a new review
    def process_new_review(new_review):
        lemmatizer = WordNetLemmatizer()
        stopwords = set(nltk.corpus.stopwords.words('english'))

        cleaned_review = clean_text(new_review)
        processed_review = preprocess_text(cleaned_review, lemmatizer, stopwords)
        tfidf_review = tfidf_vectorizer.transform([processed_review])
        reduced_review = svd_transformer.transform(tfidf_review)

        return reduced_review

    # Predict the rating for a new review
    new_review = " ".join(sys.argv)
    processed_review = process_new_review(new_review)
    predicted_rating = random_forest_model.predict(processed_review)
    
    print(2*predicted_rating[0])
   
    # sys.path.append("locationOfScript/")
except Exception as e:
    print(e)