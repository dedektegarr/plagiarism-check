import sys
import json
import nltk

nltk.download('punkt')
nltk.download('stopwords')
nltk.download('porter_test')

from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from nltk.stem import PorterStemmer

def preprocess_text(text):
    # Case Folding (mengubah menjadi huruf kecil)
    text = text.lower()

    # Tokenizing (pemecahan menjadi kata)
    tokens = word_tokenize(text)

    # Filtering Stop Words (penghapusan kata tidak penting)
    stop_words = set(stopwords.words('indonesian'))
    filtered_tokens = [word for word in tokens if word.isalnum() and word not in stop_words]

    # Stemming (penghilangan imbuhan)
    stemmer = PorterStemmer()
    stemmed_tokens = [stemmer.stem(word) for word in filtered_tokens]

    # Sorting
    sorted_tokens = sorted(stemmed_tokens)

    return sorted_tokens

if __name__ == "__main__":
    text = sys.argv[1]
    preprocess_text = preprocess_text(text)
    print(json.dumps(preprocess_text))