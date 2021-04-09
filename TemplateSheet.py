import sys
sys.path.append(".")
from MarksheetImage import MarksheetImage

marksheet = MarksheetImage()

image = marksheet.draw("text",position = (260,40),content  ="College Name is Set",style={"color":"#303931"}).get()
image.show()
