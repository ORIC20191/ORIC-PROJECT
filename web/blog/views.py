from django.shortcuts import render
from django.views.decorators.csrf import csrf_protect, csrf_exempt
from django.template import loader, Context
from django.http import HttpResponse
from forms import StudentForm
from django.http import HttpResponseRedirect
from django.core.context_processors import csrf
from django.template import RequestContext

def edit(request):
form = StudentForm(request.POST or None)
if form.is_valid():
    form.save()
    return Redirect('/upload/')
return render(request, 'upload.php',{'form':form})

# Create your views here.
