from django.db import models
from django.utils import timezone

# Create your models here.

class Post(models.Model):
    author = models.ForeignKey('auth.User', on_delete=models.CASCADE)
    title = models.CharField(max_length=200)
    text = models.TextField()
    created_date = models.DateTimeField(
            default=timezone.now)
    published_date = models.DateTimeField(
            blank=True, null=True)

    def publish(self):
        self.published_date = timezone.now()
        self.save()

    def __str__(self):
        return self.title


class Person(models.Model):
    name_user = models.CharField(max_length=200)
    email_user = models.CharField(max_length=200)


class Upload(models.Model):
   name_user = models.CharField(max_length=200)
   email_user = models.CharField(max_length=200)
   photo = models.CharField(max_length=200)
        