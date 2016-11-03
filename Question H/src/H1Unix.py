# Question 1
def mult1(numberlist):
    accumulator = 1
    for x in numberlist:
        accumulator *= x
    return accumulator

# Question 2
def mult2(numberlist):
    if len(numberlist) == 0:
        return 1
    else:
        return numberlist.pop() * (mult2(numberlist))

# Question 3
mult2(list(range(10 ** 100)))
#The integer overflow is not down to Python, integer size limit or the range function.
#In fact the overflow comes from attempting to list the number. List appears to have a size limit on integers it can represent

# Question 4
from functools import reduce
def mult3(numberlist):
    return reduce(lambda x, y: x * y, numberlist, 1)
    
    
    

# Question 5
mult1([1.0, 2, 3.0, 10])
mult2([1.0, 2, 3.0, 10])
mult3([1.0, 2, 3.0, 10])
# All return 60.0

# Question 6
# mult1 - no optimisation of a for loop possible without an incredibly smart interpreter 
# mult2 - memory and computational overheads in the call stack, not tail recursive
# mult3 - inbuilt function so exact behaviour known, could be greatly optimised for in the interpreter. Not necessarily any stack overhead, and may be tail recursive.

# Question 7
def multpoly(polylist):
    accumulator = polylist[0]
    for entry in polylist[1:]:
        if type(entry) is int:
            accumulator *= entry
        else:
            accumulator += entry
    return accumulator


# Question 8
# This method was derived from http://stackoverflow.com/a/2158522
def flatten(nestedlist):
    flattenedlist = []
    if type(nestedlist) is list:
        for nestedentry in nestedlist:
            for entry in flatten(nestedentry):
                flattenedlist.append(entry)
        return flattenedlist
    else:
        return [nestedlist]  # Which isn't actually a list in this case.

