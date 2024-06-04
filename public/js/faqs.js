function toggleAnswer(element) {
    var answer = element.querySelector('p');
    answer.style.display = (answer.style.display === 'block') ? 'none' : 'block';
}