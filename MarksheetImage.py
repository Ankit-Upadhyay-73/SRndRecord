from PIL import Image,ImageFont,ImageDraw
import json

class MarksheetImage(object):

    SourceSerif = ImageFont.truetype("/Users/Surajlad/PHPPractice/PHPResources/SourceSerifPro-SemiBold.ttf",25)
    Verdana = ImageFont.truetype("/Users/Surajlad/PHPPractice/PHPResources/Verdana.ttf", 16)

    def __new__(cls,*args,**kwargs):
        obj = super().__new__(cls)
        return obj
    
    def __init__(self,Type="RGB",position=(1280,800),color="#000000"):
        self.position = position
        self.color = color
        self.Type = Type
        self.image = Image.new(Type,position,color)

    def draw(self,draw_type,position,content=None,structure=(3,3),style={"color":"#ffffff","font-family":Verdana,"text-size":18,"font-weight":None}):
        self.draw = ImageDraw.Draw(self.image)

        if draw_type=="grid":
            
            x_start = position[0]
            y_start = position[1]
            x_end =  position[2]
            y_end =  position[3]

            computed_y = y_end/structure[0]
            computed_x = x_end/structure[1]

            for x in range(structure[0]):
                self.draw.line(((x_start,computed_y),(x_end,computed_y)),fill="#ff0000")
                computed_y += y_end/structure[0]
                                

        if draw_type=="line":
            self.draw.line(position)

        if draw_type=="text":
            self.draw.text(position,text = content,font = style.get("font-family"),color = style.get("color"))

        if draw_type=="image":
            self.image.paste(Image.open(content),position)

        return self;

    def getMarksheet(self):
        return self.image;

    
            
            
        
        
        
        
