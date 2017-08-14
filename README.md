Testing PHP's `\DateTime` and `\DateTimeImmutable`
==================================================

[Code for the course][1]

We know we should be testing our applications, but sometimes testing feels really hard. One such time is when we need to test instances of PHP's `\DateTime`, or more recently, `\DateTimeImmutable`.

The primary problem with dates and times is that they constantly and unceasingly march ever forwards.

This presents a huge problem in our tests, where we need predictability.

In this series we cover three ways to address this problem.

The first solution is to use a rough approximation, which may very well be "good enough", depending on the size and scope of your project.

The second solution is to hook into Doctrine's Lifecycle events. This is a practice that appears incredibly common, and almost inevitably involves tracking properties such as `createdAt`, and `updatedAt`. This approach should be treated with caution, though is useful to work through all the same.

The third solution is my personal preference. We will have to take on a little more work, but the overall benefits outweigh the negatives. Your mileage may vary, of course, and that's OK.

By the end of this short series you will have learned three ways to test properties that rely on PHP's `\DateTime`, and `\DateTimeImmutable`, and covered how to integrate this process with your Symfony website.

[1]: https://codereviewvideos.com/course/testing-datetime-in-php
