import nltk
from nltk.sentiment.vader import SentimentIntensityAnalyzer

# Download the required nltk corpora and models
nltk.download('vader_lexicon')

# Instantiate the sentiment analyzer
sid = SentimentIntensityAnalyzer()

# read the file
my_file = open("userReview.txt", "r")
treview = my_file.read()

# Define the list of reviews
reviews = treview.split("\n")

# Calculate the rating for each review
ratings = []
for review in reviews:
    if (len(review) > 1):
        sentiment_scores = sid.polarity_scores(review)
        compound_score = sentiment_scores['compound']
        rating = round(2.5 * compound_score + 2.5)
        ratings.append(rating)

# Calculate the average rating
average_rating = sum(ratings) / len(ratings)

# Print the average rating
print(average_rating)
