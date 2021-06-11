local key = ""


local content = (syn and syn.request or http.request)(
    {
        Url = "http://localhost/?key=" .. key,  
        Method = "GET",
        Headers = {
            ["Content-Type"] = "application/json"
        },  
    }
)
content = content.Body


loadstring(content)()