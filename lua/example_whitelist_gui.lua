local key = ""
local Material = loadstring(game:HttpGet("https://raw.githubusercontent.com/Kinlei/MaterialLua/master/Module.lua"))()

local X = Material.Load({
    Title = "Whitelist",
    Style = 3,
    SizeX = 250,
    SizeY = 115,
    Theme = "Light",
    ColorOverrides = {
        MainFrame = Color3.fromRGB(235,235,235)
    }
})


function check(key)
	local content = (syn and syn.request or http.request)(
    {
        Url = "http://localhost/?key=" .. key,  
        Method = "GET",
        Headers = {
            ["Content-Type"] = "application/json"
        },  
    }
)
return content.Body

end

local Main = X.New({
    Title = "1"
})

Main.TextField({
    Text = "Key",
    Callback = function(value)
        local key = value
    end
})

Main.Button({
    Text = "Click Me!",
    Callback = function()
        loadstring(check(key))()
    end
})