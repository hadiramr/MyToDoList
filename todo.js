document.querySelector('#push').onclick = function() {
    if (document.querySelector('#newtask input').value.length == 0) {
        alert("please enter a task");
    } else {
        document.querySelector('#tasks').innerHTML += `
            <div class="task">
                <span id="taskname">
                    ${document.querySelector('#newtask input').value}
                </span>
                <button class="delete">
                    <i class="fas fa-trash" style="color: #b31e68;"></i>
                </button>
            </div>
        `;
        var currentTask =document.querySelectorAll(".delete");
        for (var i=0; i<currentTask.length; i++){
            currentTask[i].onclick= function(){
                this.parentNode.remove();
            }
        }
        var tasks =document.querySelectorAll(".task");
        for(var i=0; i<tasks.length; i++){
            tasks[i].onclick =function(){
                this.classList.toggle('completed')
            }
        }
        document.querySelector("#newtask input").value= "";
    }
}

