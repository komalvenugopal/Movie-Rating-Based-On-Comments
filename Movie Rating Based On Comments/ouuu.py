#!/usr/bin/env python
#importing all data from files
import sys
from sklearn.externals import joblib
import nltk 
from nltk.corpus import wordnet
from nltk.tokenize import word_tokenize
from nltk import pos_tag    
from nltk.stem import WordNetLemmatizer
nltk.download('stopwords')
from nltk.corpus import stopwords
en_stops = set(stopwords.words('english'))
import string
punc=list(string.punctuation)
def get_pos_tag(tag):
    if tag.startswith("J"):
        return wordnet.ADJ
    elif tag.startswith("V"):
        return wordnet.VERB
    elif tag.startswith("N"):
        return wordnet.NOUN
    elif tag.startswith("R"):
        return wordnet.ADV
    else:
        return wordnet.NOUN
#all stopwords are stored in en_stops variable
#common words which are not relevant to document but are influencing in decreasing accuracy
commonwords=['<', 'br', '/', '>']
stop=list(en_stops)+list(punc)+commonwords
lemmatizer=WordNetLemmatizer()
ze=" ".join(sys.argv)
x_test=[ze]
ttest=[]
for i in x_test:
    a=word_tokenize(i)
    twe=[]
    for j in a:
        if j.lower() not in stop:
            d=lemmatizer.lemmatize(j,pos=get_pos_tag(pos_tag([j])[0][1]))
            twe.append(d)
    ttest.append(twe)
review_test=[]  
for i in ttest:
    a=" ".join(i)
    review_test.append(a)
coun=joblib.load('cunt.pkl')
b=coun.transform(review_test)
clf=joblib.load('filename_ud.pkl') 
y_red=clf.predict(b)
print(y_red[0])