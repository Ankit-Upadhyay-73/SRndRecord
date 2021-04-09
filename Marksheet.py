from PIL import Image,ImageFont
from PIL import ImageDraw
import json
  
  
  
# conversion to JSON done by dumps() function

marksheet_data = json.dumps({
   "id":1,
   "name":"Ankit",
   "email":"ankit@indigitalit.com",
   "gender":"Male",
   "finalresult":"Pass / Fail",
   "CGPA":"A",
   "message":"Can we do better",
   "college":[
      {
         "id":1,
         "name":"Vidyavardhini's Annasaheb Vartak College",
         "address":"Vasai Road (W), Dist. Palghar - 401202. Maharashtra, India",
         "grade":"A",
         "phone":250-2332017,
         "email":"avct23_principal@rediffmail.com",
         "logo_src":"/Users/surajlad/PHPPractice/PHPResources/vartak_logo.thumbnail",
         "reportCardType":"Template 1",
         "course":[
            {
               "id":1,
               "name":"BSC IT",
               "duration":"6 Months",
               "subject":[
                  {
                     "id":1,
                      "name":"Java",
                     "passingMarks":40,
                     "outof":100,
                     "marks":65,
                     "grade":"A"
                  },
                  {
                     "id":2,
                     "name":"C++",
                     "passingMarks":40,
                     "outof":100,
                     "marks":75,
                     "grade":"A"
                  },
                  {
                     "id":3,
                     "name":"Phython",
                     "passingMarks":40,
                     "outof":100,
                     "marks":85,
                     "grade":"A"
                  }
               ]
            }
         ]
      }
   ]
})

marksheet_data = json.loads(marksheet_data)

fntheader = ImageFont.truetype("/Users/Surajlad/PHPPractice/PHPResources/SourceSerifPro-SemiBold.ttf",25)

fntbold = ImageFont.truetype("/Users/Surajlad/PHPPractice/PHPResources/SourceSerifPro-SemiBold.ttf",18)

fnt = ImageFont.truetype("/Users/Surajlad/PHPPractice/PHPResources/Verdana.ttf", 16)

#marksheet_data = json.loads(input("Marksheeets Input"))


for colleges in marksheet_data["college"]:
    
    #result_layout created
    image = Image.new('RGB',(1280,800),'#ffffff')

    #draw instance created
    image_draw = ImageDraw.Draw(image)
    
    for college_data in colleges:
        if college_data == "name":
            image_draw.text((260,40),colleges[college_data],font = fntheader,fill="#303931")

        if college_data=="logo_src":
            image.paste(Image.open(colleges[college_data]),(65,33))
        
        if college_data =="grade":
            image_draw.text((963,75),str("Grade:"+str(colleges[college_data])),font = fntbold,fill="#303931")

        if college_data == "address":
            image_draw.text((290,75),colleges[college_data],font = fntbold,fill="#303931")

        if college_data == "phone":
            image_draw.text((320,96),str("Phone:"+str(colleges["phone"])),font = fntbold,fill="#303931")
    
        if college_data == "email" :
            image_draw.text((460,96),str("Email:"+str(colleges[college_data])),font = fntbold,fill="#303931")

        #for student

        image_draw.text((59,177),str("Student Name:"+str(marksheet_data["name"])),font = fntbold,fill="#303931")

        image_draw.text((61,225),str("Student ID:"+str(marksheet_data["id"])),font = fntbold,fill="#303931")

        image_draw.text((191,225),str("course:"+colleges["course"][0]["name"]),font = fntbold,fill="#303931")

        #for subject
        #title-headers

        #to draw text in rectangle
        image_draw.text((92,280),"Subject Id",font = fnt,fill="#303931")
        image_draw.text((222,280),"Subject Name",font = fnt,fill="#303931")
        image_draw.text((372,280),"Weightage",font = fnt,fill="#303931")
        image_draw.text((522,280),"Passing",font = fnt,fill="#303931")
        image_draw.text((672,280),"Obtained",font = fnt,fill="#303931")

        subject_x =92
        subject_y =290

        
        
        for subjects in colleges["course"][0]["subject"]:
            subject_y += 50
            subject_x =92
            for subject_data in subjects:
                if subject_data == "id" or  "name" or "outof" or "total":         
                    image_draw.text((subject_x,subject_y),str(subjects[subject_data]),font = fnt,fill="#303931")
                    subject_x += 150
    image_draw.rectangle([61,270,1216,310],outline="#000000")
    image_draw.line([(92,600),(1216,600)],fill="#303931")
        
    image.show()
