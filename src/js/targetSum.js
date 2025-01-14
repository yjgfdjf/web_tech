function targetSum(numbers, target) {
    let map = new Map();

    for (let i = 0; i < numbers.length; i++) {
        const complement = target - numbers[i];
        if (map.has(complement)) {
            return [map.get(complement), i];
        }
        map.set(numbers[i], i);
    }

    return [];
}

const numbers = [2, 7, 11, 15];
let target = 9;
console.log(targetSum(numbers, target)); // [0, 1]
target = 11;
console.log(targetSum(numbers, target)); // []