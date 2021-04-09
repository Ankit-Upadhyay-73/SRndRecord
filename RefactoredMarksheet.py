
from MarksheetImage import MarksheetImage

#drawing starts

inputted_json = [
  {
    "type": "text",
    "value": "users.name",
    "ideal": {
      "x": 12,
      "y": 12,
      "rotation": 0,
      "transform": 1.2
    },
    "style": {
      "color": "#000000",
      "background": null,
      "fontFamily": "",
      "fontSize": "",
      "fontStyle": "italic|underline",
      "fontWeight": 400
    }
  },
  {
    "type": "image",
    "value": "college.logo",
    "ideal": {
      "x": 12,
      "y": 12,
      "rotation": 0,
      "transform": 1.2
    },
    "style": {
      "color": null,
      "background": null,
      "fontFamily": null,
      "fontSize": null,
      "fontStyle": null,
      "fontWeight": null
    }
  },
  {
    "type": "rectangle",
    "value": "1px",
    "ideal": {
      "x": 12,
      "y": 12,
      "rotation": 0,
      "transform": 1.2
    },
    "style": {
      "color": "#ff0000",
      "background": "#ffffff",
      "fontFamily": null,
      "fontSize": null,
      "fontStyle": null,
      "fontWeight": null
    }
  }
]


json_data = json.loads(json.dumps(inputted_json))




marksheet = MarksheetImage().draw("grid",position = [61,270,1200,300],content = "College Name Here")
image = marksheet.getMarksheet()
image.show()

























