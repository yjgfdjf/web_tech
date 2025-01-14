function longestSuffix(strs) {
    if (strs.length < 2) return "ОШИБКА: недостаточно элементов в массиве";

    const findSuffix = (str1, str2) => {
        let i = 0;
        while (i < str1.length && i < str2.length && str1[str1.length - 1 - i] === str2[str2.length - 1 - i]) {
            i++;
        }
        return str1.slice(str1.length - i);
    };

    let commonSuffix = strs[0];
    for (let i = 1; i < strs.length; i++) {
        commonSuffix = findSuffix(commonSuffix, strs[i]);
        if (commonSuffix.length < 2) return "";
    }

    return commonSuffix;
}

const strs1 = ["цветок", "поток", "хлопок"];
console.log(longestSuffix(strs1)); // "ок"

const strs2 = ["собака", "гоночная машина", "машина"];
console.log(longestSuffix(strs2)); // ""

const strs3 = ["собака"];
console.log(longestSuffix(strs3)); // "ОШИБКА: недостаточно элементов в массиве"