# DUIBot

After watching a video of a field sobriety test I knew I had to build a neural network that could pass it!

[Read Me](https://geekgirljoy.wordpress.com/2019/05/22/dui-bot/)

## Design Considerations

   * It should be able to go forward or backward through the alphabet depending on request.
   * It should be able to arbitrarily start and stop at any requested letter combination, i.e A-Z or F-B, etc…
   * DUI Bot’s output should be able to be used as it’s input.

With these considerations in mind I decided that the best way to proceed is to use a “Two-Hot” encoding representation.

## Direction Neuron:

The first input neuron controls direction of alphabet recitation.

1 = Forward (like. A – Z )

-1 = Backward (like Z – A)

 

## Alphabet Neurons:

All the remaining input neurons are a group and represent A – Z and only one letter input neuron may be set to “high” (1) at a time and the rest of neurons should be set “low” (-1).

![DUI ANN](https://github.com/geekgirljoy/DUIBot/blob/master/DUIANN.jpg)

## Results

As you can see, DUI Bot can pass the “non-song-and-dance” portion of a sobriety test! 😛

![DUI ANN Results](https://github.com/geekgirljoy/DUIBot/blob/master/DUIBotResults.jpg)

