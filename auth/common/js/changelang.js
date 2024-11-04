function changeLanguage(switchLang) {
    //	windowObject.close(); //close pop up
    var currentPath = location.href.toString();
    var TempCurrpath = currentPath.split("#");
    currentPath = TempCurrpath[0];
    var switchEn = '/en/';
    var switchTc = '/tc/';
    var switchSc = '/sc/';
    var urlVars = document.location.search;

    //	alert(urlVars);
    switch (switchLang) {
        case '/en/':
            currentPath = currentPath.replace(switchTc, switchEn);
            currentPath = currentPath.replace(switchSc, switchEn);
            break;
        case '/tc/':
            currentPath = currentPath.replace(switchEn, switchTc);
            currentPath = currentPath.replace(switchSc, switchTc);
            break;
        case '/sc/':
            currentPath = currentPath.replace(switchEn, switchSc);
            currentPath = currentPath.replace(switchTc, switchSc);
            break;
        default:
    }
    document.location = currentPath;
    //	alert(currentPath);
}