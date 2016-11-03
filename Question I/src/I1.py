# Question 1
from math import sqrt, ceil
def isprime(number):
    if (number == 2) or (number == 3):
        return True
    
    if (number % 2 == 0) or (number % 3 == 0) or (number == 1):
        return False
    
    for counter in range(5, ceil(sqrt(number)), 6):
        if ((number % counter) == 0) or ((number % (counter + 2)) == 0):
            return False
    return True

isprime(0)
isprime(1)
isprime(2)
isprime(3)
isprime(7)
isprime(-3)
isprime(-6)
isprime(-7) #Math Domain error - interesting, yet
isprime(-8) #No error
isprime(-19) #Math domain error. So if the absolute value is prime, then this error is thrown for negative values.

def factors(number):
    accumulator = []
    for testcase in range(2, number+1, 1):
        if (number % testcase == 0) and isprime(testcase):
            accumulator.append(testcase)
    return accumulator

factors(3)
factors(12)
factors(21)
factors(29)
factors(256)


# Question 2
def largest(intlist):
    maxvalue = intlist[0]
    for value in intlist[1:]:
        if maxvalue < value:
            maxvalue = value
    return maxvalue

largest([1,2,3,4,5,6,7,8,9,0])
largest([5,4,3,3,2,1])
largest([1,2,3,4,5,6,7,8,9,10])
largest([1,1,1,1,1,1,1])
largest([1.0,2.0,3.0,4.0,5.0,6.0])
largest(['a','s','d','f','g','h','i','j','k','l'])


# Question 3
def largest_factor(number):
    return largest(factors(number))

largest_factor(23)
largest_factor(21)
largest_factor(29)
largest_factor(256)

# Question 4A - independent method
# This program treats the Fibonacci sequence as "0,1,1,2...", with "0" as the zeroeth value
def fibonacci(index):
    fiblist = [0, 1]
    if index == 0:  # edge case handling
        return fiblist[0]
    
    while index > (len(fiblist) - 1):
        nextfib = fiblist[-1] + fiblist[-2]
        fiblist.append(nextfib)
    return fiblist[-1]

fibonacci(0)
fibonacci(1)
fibonacci(2)
fibonacci(3)
fibonacci(5)
fibonacci(21)


# Question 5 - Answer
def firstbigf(number, function):
    count = 1
    while True:
        if len(str(function(count))) == number:
            return count
        count += 1

firstbigf(5,(lambda x:x**2))
firstbigf(5,(lambda x:x+1))
firstbigf(0,(lambda x:x+1))

#Question 4B - Dependent function - Answer compliant
def firstbigfib(number):
    return firstbigf(number, fibonacci)

#Note that firstbigf starts evaluating from index 1, not 0.
#Thus these answers use 1-based counting
firstbigfib(1)
firstbigfib(2)
firstbigfib(15)


# Question 7
# The methodology of calculating Pythaogrean triples was taken from Wikipedia: https://en.wikipedia.org/wiki/Formulas_for_generating_Pythagorean_triples#I.
# There are likely more comprehensive/efficient algorithms, but I haven't the mathematical clout to implement them in reasonable time
def triples():
    counter = 2
    previousresult = (4, 3, 5)
    while True:
        yield previousresult
        counter += 1
        nextresulta = previousresult[0] + previousresult[1] + previousresult[2]
        nextresultb = fibonacci((2 * counter) - 1) - previousresult[1]
        nextresultc = fibonacci(2 * counter)
        previousresult = (nextresulta, nextresultb, nextresultc)

#The islice method takes in an iterable object, and returns an iterator.
#In this case with the constraints of iterating 300(or 299?) times, starting at 1
from itertools import islice
list(islice(triples(),1,300))

x = triples()
for i in range(25):
    next(x)