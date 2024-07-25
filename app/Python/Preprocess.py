import sys
import json
import pdfplumber
import nltk

from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory

nltk.download('punkt')
nltk.download('stopwords')

def extract_text(pdfPath):
    text = ''
    with pdfplumber.open(pdfPath) as pdf:
        for page in pdf.pages:
            text += page.extract_text()

    return text

def preprocess_text(text):
    # Case Folding (mengubah menjadi huruf kecil)
    text = text.lower()

    # Tokenizing (pemecahan menjadi kata)
    tokens = word_tokenize(text)

    # Filtering Stop Words (penghapusan kata tidak penting)
    stop_words = set(stopwords.words('indonesian'))
    filtered_tokens = [word for word in tokens if word.isalnum() and word not in stop_words]

    # Stemming (penghilangan imbuhan / Indonesian stemming)
    factory = StemmerFactory()
    stemmer = factory.create_stemmer()

    join_text = ' '.join(filtered_tokens)
    stemmed_text = stemmer.stem(join_text)
    stemmed_tokens = stemmed_text.split()

    # Sorting
    sorted_tokens = sorted(stemmed_tokens)

    return sorted_tokens

if __name__ == "__main__":
    pdfPath = sys.argv[1]

    # Extract Text
    text = extract_text(pdfPath)

    # Preprocessing
    preprocessed = preprocess_text(text)

    print(json.dumps(preprocessed))
