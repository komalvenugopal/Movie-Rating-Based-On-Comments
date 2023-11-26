import os 
import numpy as np 
from sklearn.externals 
import joblib 

all_files=os.listdir("C:/wamp64/www/movierating/pos") 
path="C:/wamp64/www/movierating/pos"
s='/' 
y=[] 
filedata={} 

for file in all_files: 
	name=path+s+file
	y.append(file.split("_")[1].split('.')[0])
	f=open(name,'r',encoding="utf8") 
	filedata[name]=f.read() 
	
all_files_neg=os.listdir("C:/wamp64/www/movierating/neg") 
path_neg="C:/wamp64/www/movierating/neg"

for file in all_files_neg: 
	name=path_neg+s+file
	y.append(file.split("_")[1].split('.')[0])
	f=open(name,'r',encoding="utf8") 
	filedata[name]=f.read() 
	print(y) 

import nltk 
nltk.download('stopwords') 
from nltk.corpus import stopwords 
en_stops = set(stopwords.words('english')) 

import string punc=list(string.punctuation)
#all stopwords are stored in en_stops variable commonwords=['<', 'br', '/', '>']
stop=list(en_stops)+list(punc)+commonwords 

from nltk.corpus import wordnet 
from nltk.tokenize import word_tokenize 
x_train=filedata.values() 


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

from nltk import pos_tag
from nltk.stem import WordNetLemmatizer 
lemmatizer=WordNetLemmatizer()

reviews=[]
for i in x_train:
	a=word_tokenize(i)
	print(a) 

	re=[]
	for j in a:
		if j.lower() not in list(en_stops)+commonwords+punc:
			d=lemmatizer.lemmatize(j,pos=get_pos_tag(pos_tag([j])[0][1]))
			re.append(d)
		reviews.append(re)
	
review=[]
for i in reviews: 
	a=" ".join(i)
	review.append(a) 

all_files_test=os.listdir("C:/wamp64/www/movierating/pos") 
path_test="C:/wamp64/www/movierating/neg"
s='/'
y_test=[] 
filedata_test={}


#prediction
for file in all_files_test: 
	name=path_test+s+file
	y_test.append(file.split("_")[1].split('.')[0])
	f=open(name,'r',encoding="utf8") 
	filedata_test[name]=f.read() 
	count+=1
	
all_files_test_neg=os.listdir("C:/wamp64/www/movierating/neg") 
path_test_neg="C:/wamp64/www/movierating/neg" 
count=0

for file in all_files_test_neg: 
	name=path_test_neg+s+file
	y_test.append(file.split("_")[1].split('.')[0])
	f=open(name,'r',encoding="utf8") 
	filedata_test[name]=f.read() 
	count+=1 

from sklearn.feature_extraction.text import CountVectorizer
count_vec=CountVectorizer(max_features=15000,stop_words=stop,max_df=0.8,ngram_ran ge =(1,3))
a=count_vec.fit_transform(review) 


#SVC
from sklearn.svm import SVC
clf = SVC(C=100,gamma=0.0005)
clf.fit(a, y)

#Naive_Bayes
from sklearn.naive_bayes import MultinomialNB 
clf_multi = MultinomialNB()
clf_multi.fit(a,y)

#RandomForestClassifier
from sklearn.ensemble import RandomForestClassifier
classifier = RandomForestClassifier(n_estimators = 100, criterion = 'entropy', random_state= 41)
classifier.fit(a, y)





#TESTING
x_test=filedata_test.values() 
ttest=[] 
for i in x_test:
	a=word_tokenize(i)
	twe=[]
	for j in a: 
		if j.lower() not in stop:
			d=lemmatizer.lemmatize(j,pos=get_pos_tag(pos_tag([j])[0][1]))
		twe.append(d) 
	print(twe)
	ttest.append(twe) 

review_test=[]
for i in ttest: 
	a=" ".join(i)
	review_test.append(a) 

b=count.transform(review_test) 	

#Classification Report	
from sklearn.metrics import classification_report, confusion_matrix 

y_red=clf.predict(b)
print(classification_report(y_test,y_red))
print("-------------")

y_red=clf_multi.predict(b)
print(classification_report(y_test,y_red))
print("-------------")

y_red=classifier.predict(b)
print(classification_report(y_test,y_red))
